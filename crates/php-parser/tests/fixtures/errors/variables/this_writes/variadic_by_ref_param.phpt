===source===
<?php
function f($a, int &...$this) {}
===errors===
Cannot use $this as parameter
===php_error===
PHP Fatal error:  Cannot use $this as parameter in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            },
            {
              "name": {
                "name": "this",
                "span": {
                  "start": 29,
                  "end": 34
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 24
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 34
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
