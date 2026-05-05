===config===
min_php=8.1
===source===
<?php enum Status { case Active = ; } function use_status() { return Status::Active; }
===errors===
expected expression
Case Active of pure enum Status must not have a value
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "Status",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Active",
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
          "name": "use_status",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Identifier": "Status"
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
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
