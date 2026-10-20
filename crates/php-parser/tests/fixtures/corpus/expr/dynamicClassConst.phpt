===source===
<?php
Foo::{bar()};
$foo::{bar()};
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 2
===ast >=8.3===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccessDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "member": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccessDynamic": {
              "class": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "member": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "bar"
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
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 27,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 33
          }
        }
      },
      "span": {
        "start": 20,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
