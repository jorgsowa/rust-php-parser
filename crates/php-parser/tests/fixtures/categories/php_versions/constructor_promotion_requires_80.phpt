===source===
<?php
class Point {
    public function __construct(
        public float $x,
        public float $y,
    ) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 12,
              "end": 17
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 40,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 74,
                          "end": 76
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 68,
                              "end": 73
                            }
                          }
                        },
                        "span": {
                          "start": 68,
                          "end": 73
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 61,
                        "end": 76
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 99,
                          "end": 101
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 93,
                              "end": 98
                            }
                          }
                        },
                        "span": {
                          "start": 93,
                          "end": 98
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 86,
                        "end": 101
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 111
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
