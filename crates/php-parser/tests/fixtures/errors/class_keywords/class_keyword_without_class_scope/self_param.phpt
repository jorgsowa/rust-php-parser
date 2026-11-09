===source===
<?php
function f(self $a) {}
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
                  "start": 22,
                  "end": 24
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 24
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
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
