===config===
min_php=8.5
===source===
<?php
(array)   $a;
(bool)    $a;
(boolean) $a;
(real)    $a;
(double)  $a;
(float)   $a;
(int)     $a;
(integer) $a;
(object)  $a;
(string)  $a;
(unset)   $a;
===errors===
the (real) cast is no longer supported, use (float) instead
the (unset) cast is no longer supported
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Array",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 16,
                  "end": 18
                }
              }
            ]
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
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              }
            ]
          },
          "span": {
            "start": 20,
            "end": 32
          }
        }
      },
      "span": {
        "start": 20,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 44,
                  "end": 46
                }
              }
            ]
          },
          "span": {
            "start": 34,
            "end": 46
          }
        }
      },
      "span": {
        "start": 34,
        "end": 47
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 58,
                  "end": 60
                }
              }
            ]
          },
          "span": {
            "start": 48,
            "end": 60
          }
        }
      },
      "span": {
        "start": 48,
        "end": 61
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 72,
                  "end": 74
                }
              }
            ]
          },
          "span": {
            "start": 62,
            "end": 74
          }
        }
      },
      "span": {
        "start": 62,
        "end": 75
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Float",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 86,
                  "end": 88
                }
              }
            ]
          },
          "span": {
            "start": 76,
            "end": 88
          }
        }
      },
      "span": {
        "start": 76,
        "end": 89
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 100,
                  "end": 102
                }
              }
            ]
          },
          "span": {
            "start": 90,
            "end": 102
          }
        }
      },
      "span": {
        "start": 90,
        "end": 103
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 114,
                  "end": 116
                }
              }
            ]
          },
          "span": {
            "start": 104,
            "end": 116
          }
        }
      },
      "span": {
        "start": 104,
        "end": 117
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Object",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 128,
                  "end": 130
                }
              }
            ]
          },
          "span": {
            "start": 118,
            "end": 130
          }
        }
      },
      "span": {
        "start": 118,
        "end": 131
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "String",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 142,
                  "end": 144
                }
              }
            ]
          },
          "span": {
            "start": 132,
            "end": 144
          }
        }
      },
      "span": {
        "start": 132,
        "end": 145
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Unset",
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 156,
                  "end": 158
                }
              }
            ]
          },
          "span": {
            "start": 146,
            "end": 158
          }
        }
      },
      "span": {
        "start": 146,
        "end": 159
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 159
  }
}
===php_error===
PHP Deprecated:  Non-canonical cast (boolean) is deprecated, use the (bool) cast instead in Standard input code on line 4
PHP Parse error:  The (real) cast has been removed, use (float) instead in Standard input code on line 5
