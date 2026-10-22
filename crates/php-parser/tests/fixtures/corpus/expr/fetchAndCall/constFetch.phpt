===source===
<?php

A;
A::B;
A::class;
$a::B;
$a::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 7,
                "end": 8
              }
            }
          },
          "span": {
            "start": 7,
            "end": 8
          }
        }
      },
      "span": {
        "start": 7,
        "end": 9
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "member": {
                "kind": {
                  "Identifier": "B"
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 10,
            "end": 14
          }
        }
      },
      "span": {
        "start": 10,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 19,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 24
          }
        }
      },
      "span": {
        "start": 16,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "member": {
                "kind": {
                  "Identifier": "B"
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
            "end": 31
          }
        }
      },
      "span": {
        "start": 26,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 33,
                  "end": 35
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 37,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 42
          }
        }
      },
      "span": {
        "start": 33,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
