===source===
<?php
function f($a = new Foo) {}
#[Attr(new Foo)]
function g() {}
===errors 8.0===
'new in initializers' requires PHP 8.1 or higher
'new in initializers' requires PHP 8.1 or higher
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast 8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
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
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 29
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 29
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 60,
              "end": 61
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 40
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 45,
                                  "end": 48
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 48
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 48
                      }
                    }
                  },
                  "span": {
                    "start": 41,
                    "end": 48
                  }
                }
              ],
              "span": {
                "start": 36,
                "end": 49
              }
            }
          ]
        }
      },
      "span": {
        "start": 51,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
