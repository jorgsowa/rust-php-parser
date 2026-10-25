===source===
<?php
namespace X;
echo (PHP_INT_MAX)::class;
echo (\M_PI)::class;
echo (\PHP_EOL)::class;
echo (\PHP_INT_MAX)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors 8.0-8.2===
Cannot use "::class" on value of type float
Cannot use "::class" on value of type string
Cannot use "::class" on value of type int
===errors >=8.3===
Cannot use "::class" on float
Cannot use "::class" on string
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 3
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type float in Standard input code on line 4
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on float in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "X"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                            "start": 25,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 37
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 39,
                    "end": 44
                  }
                }
              }
            },
            "span": {
              "start": 24,
              "end": 44
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 45
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "M_PI"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 52,
                            "end": 57
                          }
                        }
                      },
                      "span": {
                        "start": 52,
                        "end": 57
                      }
                    }
                  },
                  "span": {
                    "start": 51,
                    "end": 58
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 60,
                    "end": 65
                  }
                }
              }
            },
            "span": {
              "start": 51,
              "end": 65
            }
          }
        ]
      },
      "span": {
        "start": 46,
        "end": 66
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "PHP_EOL"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 73,
                            "end": 81
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 81
                      }
                    }
                  },
                  "span": {
                    "start": 72,
                    "end": 82
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 84,
                    "end": 89
                  }
                }
              }
            },
            "span": {
              "start": 72,
              "end": 89
            }
          }
        ]
      },
      "span": {
        "start": 67,
        "end": 90
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                          "kind": "FullyQualified",
                          "span": {
                            "start": 97,
                            "end": 109
                          }
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 109
                      }
                    }
                  },
                  "span": {
                    "start": 96,
                    "end": 110
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 112,
                    "end": 117
                  }
                }
              }
            },
            "span": {
              "start": 96,
              "end": 117
            }
          }
        ]
      },
      "span": {
        "start": 91,
        "end": 118
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118
  }
}
