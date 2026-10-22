===source===
<?php
(match ($a) { default => [] })[0];
(function () {})();
[1, 2][0];
array(1)[0];
"a"->b;
"a$b"::c();
__FILE__[0];
PHP_EOL->a;
A::B::C;
print(1)[0];
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
'interpolated string dereferencing' requires PHP 8.0 or higher
'magic constant dereferencing' requires PHP 8.0 or higher
'object access on a constant' requires PHP 8.0 or higher
'class constant dereferencing' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'default' (T_DEFAULT) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Match": {
                        "subject": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        },
                        "arms": [
                          {
                            "conditions": null,
                            "body": {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 31,
                                "end": 33
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 33
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 35
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 36
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 37,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
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
                      "Closure": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [],
                        "return_type": null,
                        "body": [],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 56
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 57
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 59
          }
        }
      },
      "span": {
        "start": 41,
        "end": 60
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
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
                            "start": 62,
                            "end": 63
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 63
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 65,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 66
                      }
                    }
                  ]
                },
                "span": {
                  "start": 61,
                  "end": 67
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 68,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 70
          }
        }
      },
      "span": {
        "start": 61,
        "end": 71
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
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
                            "start": 78,
                            "end": 79
                          }
                        }
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    }
                  ]
                },
                "span": {
                  "start": 72,
                  "end": 80
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 81,
                  "end": 82
                }
              }
            }
          },
          "span": {
            "start": 72,
            "end": 83
          }
        }
      },
      "span": {
        "start": 72,
        "end": 84
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "String": "a"
                },
                "span": {
                  "start": 85,
                  "end": 88
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 90,
                  "end": 91
                }
              }
            }
          },
          "span": {
            "start": 85,
            "end": 91
          }
        }
      },
      "span": {
        "start": 85,
        "end": 92
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "a"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 95,
                          "end": 97
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 93,
                  "end": 98
                }
              },
              "method": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 100,
                  "end": 101
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 93,
            "end": 103
          }
        }
      },
      "span": {
        "start": 93,
        "end": 104
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "MagicConst": "File"
                },
                "span": {
                  "start": 105,
                  "end": 113
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 114,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 105,
            "end": 116
          }
        }
      },
      "span": {
        "start": 105,
        "end": 117
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Name": {
                    "parts": [
                      "PHP_EOL"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 118,
                      "end": 125
                    }
                  }
                },
                "span": {
                  "start": 118,
                  "end": 125
                }
              },
              "property": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 127,
                  "end": 128
                }
              }
            }
          },
          "span": {
            "start": 118,
            "end": 128
          }
        }
      },
      "span": {
        "start": 118,
        "end": 129
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
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
                            "start": 130,
                            "end": 131
                          }
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 131
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 133,
                        "end": 134
                      }
                    }
                  }
                },
                "span": {
                  "start": 130,
                  "end": 134
                }
              },
              "member": {
                "kind": {
                  "Identifier": "C"
                },
                "span": {
                  "start": 136,
                  "end": 137
                }
              }
            }
          },
          "span": {
            "start": 130,
            "end": 137
          }
        }
      },
      "span": {
        "start": 130,
        "end": 138
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 145,
                          "end": 146
                        }
                      }
                    },
                    "span": {
                      "start": 144,
                      "end": 147
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 148,
                      "end": 149
                    }
                  }
                }
              },
              "span": {
                "start": 144,
                "end": 150
              }
            }
          },
          "span": {
            "start": 139,
            "end": 150
          }
        }
      },
      "span": {
        "start": 139,
        "end": 151
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 151
  }
}
