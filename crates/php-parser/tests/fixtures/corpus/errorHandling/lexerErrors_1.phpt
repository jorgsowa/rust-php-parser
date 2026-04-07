===source===
<?php

$a = 42;
/*
$b = 24;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 7,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 14
          }
        }
      },
      "span": {
        "start": 7,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
