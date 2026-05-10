===config===
min_php=8.1
===source===
<?php $f = fn(readonly string $x) => $x;
===errors===
Cannot declare promoted property outside a constructor
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "x",
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 23,
                                "end": 29
                              }
                            }
                          },
                          "span": {
                            "start": 23,
                            "end": 29
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": true,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 14,
                          "end": 32
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
===php_error===
PHP Fatal error:  Cannot declare promoted property outside a constructor in Standard input code on line 1
