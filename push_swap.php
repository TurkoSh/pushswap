<?php

if ($argc < 2) {
    echo "Veuillez fournir une liste de nombres. \n";
    exit(1);
}

$la = [];
for ($i = 1; $i < $argc; $i++) {
    $la[] = intval($argv[$i]);
}

// Vérifier si la liste est déjà triée
$is_sorted = true;
for ($i = 1; $i < count($la); $i++) {
    if ($la[$i] < $la[$i-1]) {
        $is_sorted = false;
        break;
    }
}

if ($is_sorted) {
    exit(0);
}

$lb = [];

function sa(&$la)
{
    if (count($la) >= 2) {
        list($la[0], $la[1]) = array($la[1], $la[0]);
    }
}

function sb(&$lb)
{
    if (count($lb) >= 2) {
        list($lb[0], $lb[1]) = array($lb[1], $lb[0]);
    }
}

function sc(&$la, &$lb)
{
    sa($la);
    sb($lb);
}

function pa(&$la, &$lb)
{
    if (count($lb) > 0) {
        array_unshift($la, array_shift($lb));
    }
}

function pb(&$la, &$lb)
{
    if (count($la) > 0) {
        array_unshift($lb, array_shift($la));
    }
}

function ra(&$la)
{
    if (count($la) > 0) {
        array_push($la, array_shift($la));
    }
}

function rb(&$lb)
{
    if (count($lb) > 0) {
        array_push($lb, array_shift($lb));
    }
}

function rr(&$la, &$lb)
{
    ra($la);
    rb($lb);
}

function rra(&$la)
{
    if (count($la) > 0) {
        array_unshift($la, array_pop($la));
    }
}

function rrb(&$lb)
{
    if (count($lb) > 0) {
        array_unshift($lb, array_pop($lb));
    }
}

function rrr(&$la, &$lb)
{
    rra($la);
    rrb($lb);
}

$operations = [];

// Algorithme de tri par sélection modifié
while (count($la) > 0) {
    $min_index = 0;
    for ($i = 1; $i < count($la); $i++) {
        if ($la[$i] < $la[$min_index]) {
            $min_index = $i;
        }
    }

    for ($i = 0; $i < $min_index; $i++) {
        ra($la);
        $operations[] = 'ra';
    }

    pb($la, $lb);
    $operations[] = 'pb';

    for ($i = 0; $i < $min_index; $i++) {
        rra($la);
        $operations[] = 'rra';
    }
}

while (count($lb) > 0) {
    pa($la, $lb);
    $operations[] = 'pa';
}

echo implode(' ', $operations) . "\n";
