===source===
<?php
function f(): ?parent {}
===errors===
Cannot use "parent" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "parent"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 27
                }
              }
            },
            "span": {
              "start": 20,
              "end": 27
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
