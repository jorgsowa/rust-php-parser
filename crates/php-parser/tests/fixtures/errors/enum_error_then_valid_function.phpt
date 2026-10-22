===source===
<?php enum Status { case Active = ; } function use_status() { return Status::Active; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
expected expression, found ';'
Case Active of pure enum Status must not have a value
===errors >=8.1===
expected expression, found ';'
Case Active of pure enum Status must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Status' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Status" in Standard input code on line 1
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
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
                      "start": 25,
                      "end": 31
                    }
                  },
                  "value": {
                    "kind": "Error",
                    "span": {
                      "start": 34,
                      "end": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "use_status",
            "span": {
              "start": 47,
              "end": 57
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "Status"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 69,
                              "end": 75
                            }
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 75
                        }
                      },
                      "member": {
                        "kind": {
                          "Identifier": "Active"
                        },
                        "span": {
                          "start": 77,
                          "end": 83
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 69,
                    "end": 83
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 84
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 38,
        "end": 86
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 86
  }
}
