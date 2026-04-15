===config===
php_rejects=parse-leniency
===source===
<?php

function exit(string|int $status = 0): never {}

function die(string|int $status = 0): never {}
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
                            "start": 21,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 27
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
                            "start": 28,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 21,
                  "end": 31
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 42,
                  "end": 43
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
                "start": 21,
                "end": 43
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
                  "start": 46,
                  "end": 51
                }
              }
            },
            "span": {
              "start": 46,
              "end": 51
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 54
      }
    },
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
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 76,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 79
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 79
                }
              },
              "default": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 90,
                  "end": 91
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
                "start": 69,
                "end": 91
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
                  "start": 94,
                  "end": 99
                }
              }
            },
            "span": {
              "start": 94,
              "end": 99
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 56,
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "exit", expecting "(" in Standard input code on line 3
