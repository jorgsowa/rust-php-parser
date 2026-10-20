===source===
<?php
enum Status {
    @invalid
    case Active;
    case Inactive;
}
===errors >=8.3===
expected enum member, found '@'
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" or "const" in Standard input code on line 3
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 3
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Status",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 42,
                      "end": 48
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 37,
                "end": 49
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 59,
                      "end": 67
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
