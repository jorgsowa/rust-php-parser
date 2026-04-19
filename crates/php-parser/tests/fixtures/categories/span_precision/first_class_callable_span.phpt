===source===
<?php
$f = strlen(...);
$g = $obj->method(...);
$h = Foo::bar(...);
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Identifier": "strlen"
                        },
                        "span": {
                          "start": 11,
                          "end": 17
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 24,
                  "end": 26
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
                            "start": 29,
                            "end": 33
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "method"
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 46
          }
        }
      },
      "span": {
        "start": 24,
        "end": 47
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 48,
                  "end": 50
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
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 53,
                            "end": 56
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 58,
                            "end": 61
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 66
          }
        }
      },
      "span": {
        "start": 48,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
