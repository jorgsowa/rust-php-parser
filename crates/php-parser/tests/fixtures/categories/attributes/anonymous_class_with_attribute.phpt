===source===
<?php $x = new #[Attr] class() {};
===errors <=7.4===
expected identifier, found end of file
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": "Error",
                      "span": {
                        "start": 14,
                        "end": 14
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "Attr"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 21
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 17,
                                "end": 21
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 33
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
