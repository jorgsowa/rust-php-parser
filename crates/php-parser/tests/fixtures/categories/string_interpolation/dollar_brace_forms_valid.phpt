===source===
<?php
"${a}";
"${a[0]}";
"${a[0] }";
"${a->b}";
"${a . 1}";
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 9,
                    "end": 10
                  }
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 17,
                          "end": 18
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 19,
                          "end": 20
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 22
                  }
                }
              }
            ]
          },
          "span": {
            "start": 14,
            "end": 23
          }
        }
      },
      "span": {
        "start": 14,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 30,
                          "end": 31
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 34
                  }
                }
              }
            ]
          },
          "span": {
            "start": 25,
            "end": 35
          }
        }
      },
      "span": {
        "start": 25,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "a"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 40,
                                  "end": 41
                                }
                              }
                            },
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 44
                      }
                    }
                  },
                  "span": {
                    "start": 38,
                    "end": 45
                  }
                }
              }
            ]
          },
          "span": {
            "start": 37,
            "end": 46
          }
        }
      },
      "span": {
        "start": 37,
        "end": 47
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "a"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 51,
                                  "end": 52
                                }
                              }
                            },
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 55,
                              "end": 56
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 56
                      }
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 57
                  }
                }
              }
            ]
          },
          "span": {
            "start": 48,
            "end": 58
          }
        }
      },
      "span": {
        "start": 48,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
