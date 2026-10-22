===source===
<?php
clone($a, $b, $c)->b;
===errors <=8.4===
'clone function call' requires PHP 8.5 or higher
Cannot dereference this expression
===errors >=8.5===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "clone"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 11
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 11
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 12,
                              "end": 14
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 16,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 16,
                          "end": 18
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 20,
                              "end": 22
                            }
                          }
                        },
                        "span": {
                          "start": 20,
                          "end": 22
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 25,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
