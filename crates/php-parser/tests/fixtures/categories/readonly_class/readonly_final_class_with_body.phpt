===source===
<?php readonly final class Point { public function __construct(public int $x, public int $y) {} }
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token "final" in Standard input code on line 1
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 1
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 27,
              "end": 32
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
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
                      "start": 51,
                      "end": 62
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
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 70,
                              "end": 73
                            }
                          }
                        },
                        "span": {
                          "start": 70,
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
                        "start": 63,
                        "end": 76
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 89,
                          "end": 91
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 85,
                              "end": 88
                            }
                          }
                        },
                        "span": {
                          "start": 85,
                          "end": 88
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
                        "start": 78,
                        "end": 91
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 95
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 21,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
