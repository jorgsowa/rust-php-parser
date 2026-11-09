===source===
<?php
function a(never ...$b) {}
===errors >=8.1===
never cannot be used as a parameter type
===php_error >=8.1===
PHP Fatal error:  never cannot be used as a parameter type in Standard input code on line 2
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
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "never"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 28
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
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
