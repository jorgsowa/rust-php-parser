===source===
<?php
$"abc";
$1;
$a->$"b";
A::$"b";
new $"A";
===errors===
expected variable, found string
expected variable, found integer
expected variable, found string
expected variable, found string
expected variable, found string
===php_error===
PHP Parse error:  syntax error, unexpected double-quoted string "abc", expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "String": "abc"
              },
              "span": {
                "start": 7,
                "end": 12
              }
            }
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
            "VariableVariable": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 15,
                "end": 16
              }
            }
          },
          "span": {
            "start": 14,
            "end": 16
          }
        }
      },
      "span": {
        "start": 14,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "property": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 26
          }
        }
      },
      "span": {
        "start": 18,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 29
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 32,
                      "end": 35
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 35
          }
        }
      },
      "span": {
        "start": 28,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "A"
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 45
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 37,
            "end": 45
          }
        }
      },
      "span": {
        "start": 37,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
