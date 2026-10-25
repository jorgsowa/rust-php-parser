===source===
<?php
$o->{1}();
$o->{1.5}();
$o->{-1}();
$o->{true}();
$o->{null}(...);
A::{1 + 1}();
$o->{"a" . 1}();
$o->{1};
$o->true();
===errors <=8.0===
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
'first-class callable syntax' requires PHP 8.1 or higher
Method name must be a string
===errors >=8.1===
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
Method name must be a string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 6
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 6
===php_error >=8.1===
PHP Fatal error:  Method name must be a string in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 11,
                  "end": 12
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
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "method": {
                "kind": {
                  "Float": 1.5
                },
                "span": {
                  "start": 22,
                  "end": 25
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 17,
            "end": 28
          }
        }
      },
      "span": {
        "start": 17,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 30,
                  "end": 32
                }
              },
              "method": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 36,
                        "end": 37
                      }
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 30,
            "end": 40
          }
        }
      },
      "span": {
        "start": 30,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              },
              "method": {
                "kind": {
                  "Bool": true
                },
                "span": {
                  "start": 47,
                  "end": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 42,
            "end": 54
          }
        }
      },
      "span": {
        "start": 42,
        "end": 55
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "Variable": "o"
                    },
                    "span": {
                      "start": 56,
                      "end": 58
                    }
                  },
                  "method": {
                    "kind": "Null",
                    "span": {
                      "start": 61,
                      "end": 65
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 56,
            "end": 71
          }
        }
      },
      "span": {
        "start": 56,
        "end": 72
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCallDynamic": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 73,
                      "end": 74
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 74
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 77,
                        "end": 78
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 81,
                        "end": 82
                      }
                    }
                  }
                },
                "span": {
                  "start": 77,
                  "end": 82
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 73,
            "end": 85
          }
        }
      },
      "span": {
        "start": 73,
        "end": 86
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 87,
                  "end": 89
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 92,
                        "end": 95
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 98,
                        "end": 99
                      }
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 99
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 87,
            "end": 102
          }
        }
      },
      "span": {
        "start": 87,
        "end": 103
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 104,
                  "end": 106
                }
              },
              "property": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 109,
                  "end": 110
                }
              }
            }
          },
          "span": {
            "start": 104,
            "end": 111
          }
        }
      },
      "span": {
        "start": 104,
        "end": 112
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 113,
                  "end": 115
                }
              },
              "method": {
                "kind": {
                  "Identifier": "true"
                },
                "span": {
                  "start": 117,
                  "end": 121
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 113,
            "end": 123
          }
        }
      },
      "span": {
        "start": 113,
        "end": 124
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 124
  }
}
