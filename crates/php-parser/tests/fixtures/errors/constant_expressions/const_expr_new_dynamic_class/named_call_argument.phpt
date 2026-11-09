===source===
<?php
function f($a = new Foo(a: f())) {}
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
'new in initializers' requires PHP 8.1 or higher
===errors 8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
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
                    "args": [
                      {
                        "name": {
                          "parts": [
                            "a"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 30,
                            "end": 31
                          }
                        },
                        "kind": {
                          "Value": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "f"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 33,
                                        "end": 34
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 33,
                                    "end": 34
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 33,
                              "end": 36
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 22,
                  "end": 37
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 37
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
