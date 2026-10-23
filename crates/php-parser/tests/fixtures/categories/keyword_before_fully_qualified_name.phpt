===source===
<?php
include \dirname(__DIR__);
print \x();
fn\use();
private\protected\x();
exit(\foo());
require_once \A::B;
$a = clone \foo();
===errors <=7.4===
expected '(', found '\'
'reserved keyword in namespaced name' requires PHP 8.0 or higher
expected variable, found '('
expected ')', found '('
expected '=>', found '('
expected expression, found ')'
expected expression, found 'private'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '\' (T_NS_SEPARATOR), expecting '(' in Standard input code on line 4
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "dirname"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 14,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 22
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "MagicConst": "Dir"
                            },
                            "span": {
                              "start": 23,
                              "end": 30
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 14,
                  "end": 31
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "x"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 39,
                          "end": 41
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 39,
                "end": 43
              }
            }
          },
          "span": {
            "start": 33,
            "end": 43
          }
        }
      },
      "span": {
        "start": 33,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": null,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "use"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 47,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 51
                    }
                  },
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 47,
                    "end": 51
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Parenthesized": {
                    "kind": "Error",
                    "span": {
                      "start": 52,
                      "end": 52
                    }
                  }
                },
                "span": {
                  "start": 51,
                  "end": 53
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 45,
            "end": 53
          }
        }
      },
      "span": {
        "start": 45,
        "end": 54
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 55,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "foo"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 83,
                          "end": 87
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 87
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 83,
                "end": 89
              }
            }
          },
          "span": {
            "start": 78,
            "end": 90
          }
        }
      },
      "span": {
        "start": 78,
        "end": 91
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 105,
                            "end": 107
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 109,
                        "end": 110
                      }
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 110
                }
              }
            ]
          },
          "span": {
            "start": 92,
            "end": 110
          }
        }
      },
      "span": {
        "start": 92,
        "end": 111
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 112,
                  "end": 114
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "foo"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 123,
                                "end": 127
                              }
                            }
                          },
                          "span": {
                            "start": 123,
                            "end": 127
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 129
                    }
                  }
                },
                "span": {
                  "start": 117,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 112,
            "end": 129
          }
        }
      },
      "span": {
        "start": 112,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Include",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "dirname"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 14,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 22
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "MagicConst": "Dir"
                            },
                            "span": {
                              "start": 23,
                              "end": 30
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 14,
                  "end": 31
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "x"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 39,
                          "end": 41
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 39,
                "end": 43
              }
            }
          },
          "span": {
            "start": 33,
            "end": 43
          }
        }
      },
      "span": {
        "start": 33,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "fn",
                      "use"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 45,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 45,
            "end": 53
          }
        }
      },
      "span": {
        "start": 45,
        "end": 54
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "private",
                      "protected",
                      "x"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 55,
                      "end": 74
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 74
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 55,
            "end": 76
          }
        }
      },
      "span": {
        "start": 55,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "foo"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 83,
                          "end": 87
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 87
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 83,
                "end": 89
              }
            }
          },
          "span": {
            "start": 78,
            "end": 90
          }
        }
      },
      "span": {
        "start": 78,
        "end": 91
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 105,
                            "end": 107
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 109,
                        "end": 110
                      }
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 110
                }
              }
            ]
          },
          "span": {
            "start": 92,
            "end": 110
          }
        }
      },
      "span": {
        "start": 92,
        "end": 111
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 112,
                  "end": 114
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "foo"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 123,
                                "end": 127
                              }
                            }
                          },
                          "span": {
                            "start": 123,
                            "end": 127
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 129
                    }
                  }
                },
                "span": {
                  "start": 117,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 112,
            "end": 129
          }
        }
      },
      "span": {
        "start": 112,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}
