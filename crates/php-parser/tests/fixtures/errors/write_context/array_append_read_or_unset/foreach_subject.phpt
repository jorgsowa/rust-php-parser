===source===
<?php
foreach ($a[] as $b) {}
===errors===
Cannot use [] for reading
===php_error===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 15,
                    "end": 17
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 15,
              "end": 19
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 23,
              "end": 25
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 27,
              "end": 29
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
