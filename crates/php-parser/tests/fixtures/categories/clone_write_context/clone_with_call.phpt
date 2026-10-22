===source===
<?php
(clone($a, []))->b = 1;
(clone $a)::$s = 1;
===errors <=8.4===
'clone with property overrides' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "CloneWith": [
                              {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 13,
                                  "end": 15
                                }
                              },
                              {
                                "kind": {
                                  "Array": []
                                },
                                "span": {
                                  "start": 17,
                                  "end": 19
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 7,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 21
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Clone": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 37,
                                "end": 39
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 40
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "s"
                      },
                      "span": {
                        "start": 42,
                        "end": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 44
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 47,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 48
          }
        }
      },
      "span": {
        "start": 30,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
