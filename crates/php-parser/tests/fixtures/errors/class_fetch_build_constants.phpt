===source===
<?php
(ZEND_THREAD_SAFE)::class;
(\ZEND_DEBUG_BUILD)::class;
(PHP_ZTS)::class;
(PHP_DEBUG)::class;
(!ZEND_THREAD_SAFE)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors 8.0-8.2===
Cannot use "::class" on value of type bool
Cannot use "::class" on value of type bool
Cannot use "::class" on value of type int
Cannot use "::class" on value of type int
Cannot use "::class" on value of type bool
===errors 8.3===
Cannot use "::class" on bool
Cannot use "::class" on bool
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on bool
===errors >=8.4===
Cannot use "::class" on bool
Cannot use "::class" on bool
Cannot use "::class" on bool
Cannot use "::class" on bool
Cannot use "::class" on bool
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on false in Standard input code on line 2
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
                          "ZEND_THREAD_SAFE"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 7,
                          "end": 23
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 24
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 26,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
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
                          "ZEND_DEBUG_BUILD"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 34,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 52
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 54,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 59
          }
        }
      },
      "span": {
        "start": 33,
        "end": 60
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
                          "PHP_ZTS"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 62,
                          "end": 69
                        }
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 69
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 70
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 72,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 77
          }
        }
      },
      "span": {
        "start": 61,
        "end": 78
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
                          "PHP_DEBUG"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 80,
                          "end": 89
                        }
                      }
                    },
                    "span": {
                      "start": 80,
                      "end": 89
                    }
                  }
                },
                "span": {
                  "start": 79,
                  "end": 90
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 92,
                  "end": 97
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 97
          }
        }
      },
      "span": {
        "start": 79,
        "end": 98
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
                      "UnaryPrefix": {
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "ZEND_THREAD_SAFE"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 101,
                                "end": 117
                              }
                            }
                          },
                          "span": {
                            "start": 101,
                            "end": 117
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 100,
                      "end": 117
                    }
                  }
                },
                "span": {
                  "start": 99,
                  "end": 118
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 120,
                  "end": 125
                }
              }
            }
          },
          "span": {
            "start": 99,
            "end": 125
          }
        }
      },
      "span": {
        "start": 99,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}
