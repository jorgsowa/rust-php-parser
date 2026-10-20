===source===
<?php
$fn = strlen(...);
$fn = $obj->method(...);
$fn = Foo::bar(...);
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "strlen"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 12,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 18
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Method": {
                        "object": {
                          "kind": {
                            "Variable": "obj"
                          },
                          "span": {
                            "start": 31,
                            "end": 35
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "method"
                          },
                          "span": {
                            "start": 37,
                            "end": 43
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 48
          }
        }
      },
      "span": {
        "start": 25,
        "end": 49
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 50,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 56,
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 56,
                            "end": 59
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 61,
                            "end": 64
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 69
          }
        }
      },
      "span": {
        "start": 50,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
