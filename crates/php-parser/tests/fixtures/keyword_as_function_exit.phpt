===config===
php_rejects=parse-leniency
===source===
<?php function exit(string|int $status = 0): never {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "exit",
          "params": [
            {
              "name": "status",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 26
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 30
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 41,
                  "end": 42
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 20,
                "end": 42
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 45,
                  "end": 50
                }
              }
            },
            "span": {
              "start": 45,
              "end": 50
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "exit", expecting "(" in Standard input code on line 1
