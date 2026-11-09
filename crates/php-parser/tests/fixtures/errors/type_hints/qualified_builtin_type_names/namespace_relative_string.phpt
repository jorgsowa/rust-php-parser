===source===
<?php
function a(namespace\string $b) {}
===errors===
Type declaration 'string' must be unqualified
===php_error===
PHP Fatal error:  Type declaration 'string' must be unqualified in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 34,
                  "end": 36
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 17,
                      "end": 33
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 33
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 36
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
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
