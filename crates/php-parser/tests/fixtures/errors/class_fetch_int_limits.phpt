===source===
<?php
(PHP_INT_MAX)::class;
(\PHP_INT_SIZE)::class;
(PHP_INT_SIZE == 8)::class;
$o->{PHP_INT_MAX}();
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Method name must be a string
===errors 8.0-8.2===
Cannot use "::class" on value of type int
Cannot use "::class" on value of type int
Cannot use "::class" on value of type bool
Method name must be a string
===errors >=8.3===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on bool
Method name must be a string
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_INT_MAX"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 18
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 21,
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_INT_SIZE"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 29,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 42
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 43
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 45,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 50
          }
        }
      },
      "span": {
        "start": 28,
        "end": 51
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "PHP_INT_SIZE"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 53,
                                "end": 65
                              }
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 65
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": {
                            "Int": 8
                          },
                          "span": {
                            "start": 69,
                            "end": 70
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 70
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 71
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 73,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 78
          }
        }
      },
      "span": {
        "start": 52,
        "end": 79
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 80,
                  "end": 82
                }
              },
              "method": {
                "kind": {
                  "Name": {
                    "parts": [
                      "PHP_INT_MAX"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 85,
                      "end": 96
                    }
                  }
                },
                "span": {
                  "start": 85,
                  "end": 96
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 80,
            "end": 99
          }
        }
      },
      "span": {
        "start": 80,
        "end": 100
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 100
  }
}
