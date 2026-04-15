===config===
php_rejects=parse-leniency
===source===
<?php function die(string|int $status = 0): never {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "die",
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
                            "start": 19,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 25
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
                            "start": 26,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 29
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 40,
                  "end": 41
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
                "start": 19,
                "end": 41
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
                  "start": 44,
                  "end": 49
                }
              }
            },
            "span": {
              "start": 44,
              "end": 49
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "exit", expecting "(" in Standard input code on line 1
