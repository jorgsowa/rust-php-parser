===source===
<?php
new $className;
new $array['className'];
new $obj->className;
new Test::$className;
new $test::$className;
new $weird[0]->foo::$className;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Variable": "className"
                },
                "span": {
                  "start": 10,
                  "end": 20,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "array"
                      },
                      "span": {
                        "start": 26,
                        "end": 32,
                        "start_line": 3,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 32,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "className"
                },
                "span": {
                  "start": 33,
                  "end": 44,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 45,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 47,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 51,
                        "end": 55,
                        "start_line": 4,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 47,
                  "end": 55,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "className"
                },
                "span": {
                  "start": 57,
                  "end": 66,
                  "start_line": 4,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 66,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 68,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Test"
                      },
                      "span": {
                        "start": 72,
                        "end": 76,
                        "start_line": 5,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 68,
                  "end": 76,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "member": "className"
            }
          },
          "span": {
            "start": 68,
            "end": 88,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 68,
        "end": 90,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "test"
                      },
                      "span": {
                        "start": 94,
                        "end": 99,
                        "start_line": 6,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 90,
                  "end": 99,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "member": "className"
            }
          },
          "span": {
            "start": 90,
            "end": 111,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 90,
        "end": 113,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "New": {
                                "class": {
                                  "kind": {
                                    "Variable": "weird"
                                  },
                                  "span": {
                                    "start": 117,
                                    "end": 123,
                                    "start_line": 7,
                                    "start_col": 4
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 113,
                              "end": 123,
                              "start_line": 7,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 124,
                              "end": 125,
                              "start_line": 7,
                              "start_col": 11
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 113,
                        "end": 126,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 128,
                        "end": 131,
                        "start_line": 7,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 131,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "member": "className"
            }
          },
          "span": {
            "start": 113,
            "end": 143,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 113,
        "end": 144,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 144,
    "start_line": 1,
    "start_col": 0
  }
}
