===source===
<?php
[]::foo();
[1]::C;
array(1)::$x;
[1]::class;
===errors===
Illegal class name
Illegal class name
Illegal class name
Cannot use "::class" on array
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "member": {
                "kind": {
                  "Identifier": "C"
                },
                "span": {
                  "start": 22,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 23
          }
        }
      },
      "span": {
        "start": 17,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 31,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 33
                }
              },
              "member": {
                "kind": {
                  "Identifier": "x"
                },
                "span": {
                  "start": 35,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 37
          }
        }
      },
      "span": {
        "start": 25,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
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
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 42
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 44,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 49
          }
        }
      },
      "span": {
        "start": 39,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
