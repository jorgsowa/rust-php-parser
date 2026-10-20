===source===
<?php
__CLASS__->a;
__CLASS__?->a;
__CLASS__->m();
__LINE__[0];
(__CLASS__)();
(__CLASS__)::X;
(__CLASS__)::$a;
__CLASS__ . "x";
__CLASS__ instanceof A;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "property": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
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
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 20,
                  "end": 29
                }
              },
              "property": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 32,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 33
          }
        }
      },
      "span": {
        "start": 20,
        "end": 34
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 35,
                  "end": 44
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 46,
                  "end": 47
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 35,
            "end": 49
          }
        }
      },
      "span": {
        "start": 35,
        "end": 50
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "MagicConst": "Line"
                },
                "span": {
                  "start": 51,
                  "end": 59
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 60,
                  "end": 61
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 62
          }
        }
      },
      "span": {
        "start": 51,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "MagicConst": "Class"
                    },
                    "span": {
                      "start": 65,
                      "end": 74
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 75
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 64,
            "end": 77
          }
        }
      },
      "span": {
        "start": 64,
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
                      "MagicConst": "Class"
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
                  "Identifier": "X"
                },
                "span": {
                  "start": 92,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 93
          }
        }
      },
      "span": {
        "start": 79,
        "end": 94
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "MagicConst": "Class"
                    },
                    "span": {
                      "start": 96,
                      "end": 105
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 106
                }
              },
              "member": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 108,
                  "end": 110
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 110
          }
        }
      },
      "span": {
        "start": 95,
        "end": 111
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 112,
                  "end": 121
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 124,
                  "end": 127
                }
              }
            }
          },
          "span": {
            "start": 112,
            "end": 127
          }
        }
      },
      "span": {
        "start": 112,
        "end": 128
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "MagicConst": "Class"
                },
                "span": {
                  "start": 129,
                  "end": 138
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 150,
                      "end": 151
                    }
                  }
                },
                "span": {
                  "start": 150,
                  "end": 151
                }
              }
            }
          },
          "span": {
            "start": 129,
            "end": 151
          }
        }
      },
      "span": {
        "start": 129,
        "end": 152
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 152
  }
}
