===config===
min_php=8.1
===source===
<?php
enum Status: int {
    case Active = 1 +;
    case Inactive = 2;
}
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 19,
              "end": 22
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": "Error",
                          "span": {
                            "start": 46,
                            "end": 47
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 47
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Inactive",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 68,
                      "end": 69
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
