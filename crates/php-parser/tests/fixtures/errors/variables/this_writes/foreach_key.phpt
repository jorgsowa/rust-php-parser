===source===
<?php
foreach ($a as $this => $v) {}
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 21,
              "end": 26
            }
          },
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 30,
              "end": 32
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 34,
              "end": 36
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
