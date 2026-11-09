===source===
<?php
function f(namespace\self $a) {}
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 2
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
                  "start": 32,
                  "end": 34
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 17,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 31
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
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
