===source===
<?php
$class = 'Foo';
$obj1 = new $$class();
$key = 'class';
$obj2 = new ${$key}();
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
                  "Variable": "class"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Foo"
                },
                "span": {
                  "start": 15,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj1"
                },
                "span": {
                  "start": 22,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "class"
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 41
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 30,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 43
          }
        }
      },
      "span": {
        "start": 22,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "key"
                },
                "span": {
                  "start": 45,
                  "end": 49
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "class"
                },
                "span": {
                  "start": 52,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 45,
            "end": 59
          }
        }
      },
      "span": {
        "start": 45,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj2"
                },
                "span": {
                  "start": 61,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "key"
                          },
                          "span": {
                            "start": 75,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 73,
                        "end": 80
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 69,
                  "end": 82
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 82
          }
        }
      },
      "span": {
        "start": 61,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}
