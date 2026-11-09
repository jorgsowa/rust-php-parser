===source===
<?php
function a(): ?never {}
===errors >=8.1===
never can only be used as a standalone type
===php_error >=8.1===
PHP Fatal error:  never can only be used as a standalone type in Standard input code on line 2
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
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "never"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 26
                }
              }
            },
            "span": {
              "start": 20,
              "end": 26
            }
          },
          "by_ref": false,
          "attributes": []
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
