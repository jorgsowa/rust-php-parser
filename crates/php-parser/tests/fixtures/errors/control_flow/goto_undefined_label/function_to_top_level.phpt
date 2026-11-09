===source===
<?php
outer:
function f() {
    goto outer;
}
===errors===
'goto' to undefined label 'outer'
===php_error===
PHP Fatal error:  'goto' to undefined label 'outer' in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": {
          "name": "outer",
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Goto": {
                  "name": "outer",
                  "span": {
                    "start": 37,
                    "end": 42
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 43
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 13,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
