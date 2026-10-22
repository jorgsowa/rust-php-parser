===source===
<?php
$a = f(...,);
$b = f(1, ...,);
$c = f(?, ...,);
$d = $o->m(...,);
$e = A::m(a: 1, ...,);
===errors <=7.4===
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'named arguments' requires PHP 8.0 or higher
'partial function application' requires PHP 8.6 or higher
===errors 8.0-8.5===
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 2
===php_error 8.0-8.5===
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 11,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 13,
                          "end": 16
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 20,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 25,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 26
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 27,
                              "end": 28
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      },
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 30,
                          "end": 33
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 25,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 35
          }
        }
      },
      "span": {
        "start": 20,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 42,
                            "end": 43
                          }
                        }
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "Placeholder",
                        "span": {
                          "start": 44,
                          "end": 45
                        }
                      },
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 47,
                          "end": 50
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 42,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 52
          }
        }
      },
      "span": {
        "start": 37,
        "end": 53
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 54,
                  "end": 56
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "o"
                      },
                      "span": {
                        "start": 59,
                        "end": 61
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "m"
                      },
                      "span": {
                        "start": 63,
                        "end": 64
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 65,
                          "end": 68
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 59,
                  "end": 70
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 70
          }
        }
      },
      "span": {
        "start": 54,
        "end": 71
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 72,
                  "end": 74
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 77,
                            "end": 78
                          }
                        }
                      },
                      "span": {
                        "start": 77,
                        "end": 78
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "m"
                      },
                      "span": {
                        "start": 80,
                        "end": 81
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
                            "start": 82,
                            "end": 83
                          }
                        },
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 85,
                              "end": 86
                            }
                          }
                        },
                        "span": {
                          "start": 82,
                          "end": 86
                        }
                      },
                      {
                        "name": null,
                        "kind": "SpreadPlaceholder",
                        "span": {
                          "start": 88,
                          "end": 91
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 77,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 72,
            "end": 93
          }
        }
      },
      "span": {
        "start": 72,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
