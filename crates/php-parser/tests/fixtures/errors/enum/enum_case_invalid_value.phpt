===source===
<?php
enum Status: int {
    case Active = 1 +;
    case Inactive = 2;
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
expected expression, found ';'
===errors >=8.1===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 2
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
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
                  "name": {
                    "name": "Active",
                    "span": {
                      "start": 34,
                      "end": 40
                    }
                  },
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
                            "end": 46
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 46
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
                  "name": {
                    "name": "Inactive",
                    "span": {
                      "start": 57,
                      "end": 65
                    }
                  },
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
