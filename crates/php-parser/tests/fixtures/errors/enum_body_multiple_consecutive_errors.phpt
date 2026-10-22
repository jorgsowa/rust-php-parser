===source===
<?php
enum Status {
    @invalid1
    case Active;
    @invalid2
    case Inactive;
    @invalid3
    case Pending;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
expected enum member, found '@'
expected enum member, found '@'
expected enum member, found '@'
===errors >=8.1===
expected enum member, found '@'
expected enum member, found '@'
expected enum member, found '@'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" or "const" in Standard input code on line 3
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 3
===ast===
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
                      "start": 43,
                      "end": 49
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 50
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 74,
                      "end": 82
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 83
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Pending",
                    "span": {
                      "start": 107,
                      "end": 114
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 102,
                "end": 115
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 117
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 117
  }
}
