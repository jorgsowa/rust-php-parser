===source===
<?php
E::A->p = 1;
E::A->p[] = 1;
E::A[0]->p->q = 1;
E::{'A'}->p .= 1;
unset(E::A->p);
$a = &E::A->p;
E::A->p++;
foreach ($b as E::A->p) {}
[E::A->p] = [1];
FOO->p = 1;
(FOO)->p = 1;
\FOO[0]->p = 1;
true->p = 1;
null->p = 1;
E::A[0] = 1;
E::class->p = 1;
__CLASS__->p = 1;
(new A)->p = 1;
===errors <=8.2===
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
'dynamic class constant fetch' requires PHP 8.3 or higher
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Assignments can only happen to writable values
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
===errors 8.3-8.5===
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Assignments can only happen to writable values
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
===errors >=8.6===
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "->", expecting "(" in Standard input code on line 5
===php_error 8.3-8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 16
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 6,
                                  "end": 7
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 7
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 9,
                              "end": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 10
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "E"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 19,
                                        "end": 20
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 19,
                                    "end": 20
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "A"
                                  },
                                  "span": {
                                    "start": 22,
                                    "end": 23
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 19,
                              "end": 23
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 26
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 19,
                  "end": 28
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 31,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 32
          }
        }
      },
      "span": {
        "start": 19,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "ClassConstAccess": {
                                      "class": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "E"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 34,
                                              "end": 35
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 34,
                                          "end": 35
                                        }
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "A"
                                        },
                                        "span": {
                                          "start": 37,
                                          "end": 38
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 34,
                                    "end": 38
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 39,
                                    "end": 40
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 34,
                              "end": 41
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "p"
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 44
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "q"
                      },
                      "span": {
                        "start": 46,
                        "end": 47
                      }
                    }
                  }
                },
                "span": {
                  "start": 34,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 50,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 51
          }
        }
      },
      "span": {
        "start": 34,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ClassConstAccessDynamic": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 53,
                                  "end": 54
                                }
                              }
                            },
                            "span": {
                              "start": 53,
                              "end": 54
                            }
                          },
                          "member": {
                            "kind": {
                              "String": "A"
                            },
                            "span": {
                              "start": 57,
                              "end": 60
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 61
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 63,
                        "end": 64
                      }
                    }
                  }
                },
                "span": {
                  "start": 53,
                  "end": 64
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 68,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 53,
            "end": 69
          }
        }
      },
      "span": {
        "start": 53,
        "end": 70
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 78
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 78
                        }
                      },
                      "member": {
                        "kind": {
                          "Identifier": "A"
                        },
                        "span": {
                          "start": 80,
                          "end": 81
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 81
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 83,
                    "end": 84
                  }
                }
              }
            },
            "span": {
              "start": 77,
              "end": 84
            }
          }
        ]
      },
      "span": {
        "start": 71,
        "end": 86
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
                  "start": 87,
                  "end": 89
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 93,
                                  "end": 94
                                }
                              }
                            },
                            "span": {
                              "start": 93,
                              "end": 94
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 96,
                              "end": 97
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 97
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 99,
                        "end": 100
                      }
                    }
                  }
                },
                "span": {
                  "start": 93,
                  "end": 100
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 87,
            "end": 100
          }
        }
      },
      "span": {
        "start": 87,
        "end": 101
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 102,
                                  "end": 103
                                }
                              }
                            },
                            "span": {
                              "start": 102,
                              "end": 103
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 105,
                              "end": 106
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 102,
                        "end": 106
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 108,
                        "end": 109
                      }
                    }
                  }
                },
                "span": {
                  "start": 102,
                  "end": 109
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 102,
            "end": 111
          }
        }
      },
      "span": {
        "start": 102,
        "end": 112
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 122,
              "end": 124
            }
          },
          "key": null,
          "value": {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "ClassConstAccess": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 128,
                              "end": 129
                            }
                          }
                        },
                        "span": {
                          "start": 128,
                          "end": 129
                        }
                      },
                      "member": {
                        "kind": {
                          "Identifier": "A"
                        },
                        "span": {
                          "start": 131,
                          "end": 132
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 128,
                    "end": 132
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 134,
                    "end": 135
                  }
                }
              }
            },
            "span": {
              "start": 128,
              "end": 135
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 137,
              "end": 139
            }
          }
        }
      },
      "span": {
        "start": 113,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "E"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 141,
                                            "end": 142
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 141,
                                        "end": 142
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "A"
                                      },
                                      "span": {
                                        "start": 144,
                                        "end": 145
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 141,
                                  "end": 145
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 147,
                                  "end": 148
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 141,
                            "end": 148
                          }
                        }
                      },
                      "span": {
                        "start": 141,
                        "end": 148
                      }
                    }
                  ]
                },
                "span": {
                  "start": 140,
                  "end": 149
                }
              },
              "op": "Assign",
              "value": {
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
                            "start": 153,
                            "end": 154
                          }
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 154
                      }
                    }
                  ]
                },
                "span": {
                  "start": 152,
                  "end": 155
                }
              }
            }
          },
          "span": {
            "start": 140,
            "end": 155
          }
        }
      },
      "span": {
        "start": 140,
        "end": 156
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "FOO"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 157,
                            "end": 160
                          }
                        }
                      },
                      "span": {
                        "start": 157,
                        "end": 160
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 162,
                        "end": 163
                      }
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 163
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 166,
                  "end": 167
                }
              }
            }
          },
          "span": {
            "start": 157,
            "end": 167
          }
        }
      },
      "span": {
        "start": 157,
        "end": 168
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "FOO"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 170,
                                "end": 173
                              }
                            }
                          },
                          "span": {
                            "start": 170,
                            "end": 173
                          }
                        }
                      },
                      "span": {
                        "start": 169,
                        "end": 174
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 176,
                        "end": 177
                      }
                    }
                  }
                },
                "span": {
                  "start": 169,
                  "end": 177
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 180,
                  "end": 181
                }
              }
            }
          },
          "span": {
            "start": 169,
            "end": 181
          }
        }
      },
      "span": {
        "start": 169,
        "end": 182
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "FOO"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 183,
                                  "end": 187
                                }
                              }
                            },
                            "span": {
                              "start": 183,
                              "end": 187
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 188,
                              "end": 189
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 183,
                        "end": 190
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 192,
                        "end": 193
                      }
                    }
                  }
                },
                "span": {
                  "start": 183,
                  "end": 193
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 196,
                  "end": 197
                }
              }
            }
          },
          "span": {
            "start": 183,
            "end": 197
          }
        }
      },
      "span": {
        "start": 183,
        "end": 198
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 199,
                        "end": 203
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 205,
                        "end": 206
                      }
                    }
                  }
                },
                "span": {
                  "start": 199,
                  "end": 206
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 209,
                  "end": 210
                }
              }
            }
          },
          "span": {
            "start": 199,
            "end": 210
          }
        }
      },
      "span": {
        "start": 199,
        "end": 211
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": "Null",
                      "span": {
                        "start": 212,
                        "end": 216
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 218,
                        "end": 219
                      }
                    }
                  }
                },
                "span": {
                  "start": 212,
                  "end": 219
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 222,
                  "end": 223
                }
              }
            }
          },
          "span": {
            "start": 212,
            "end": 223
          }
        }
      },
      "span": {
        "start": 212,
        "end": 224
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 225,
                                  "end": 226
                                }
                              }
                            },
                            "span": {
                              "start": 225,
                              "end": 226
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 228,
                              "end": 229
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 225,
                        "end": 229
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 230,
                        "end": 231
                      }
                    }
                  }
                },
                "span": {
                  "start": 225,
                  "end": 232
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 235,
                  "end": 236
                }
              }
            }
          },
          "span": {
            "start": 225,
            "end": 236
          }
        }
      },
      "span": {
        "start": 225,
        "end": 237
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 238,
                                  "end": 239
                                }
                              }
                            },
                            "span": {
                              "start": 238,
                              "end": 239
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 241,
                              "end": 246
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 238,
                        "end": 246
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 248,
                        "end": 249
                      }
                    }
                  }
                },
                "span": {
                  "start": 238,
                  "end": 249
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 252,
                  "end": 253
                }
              }
            }
          },
          "span": {
            "start": 238,
            "end": 253
          }
        }
      },
      "span": {
        "start": 238,
        "end": 254
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "MagicConst": "Class"
                      },
                      "span": {
                        "start": 255,
                        "end": 264
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 266,
                        "end": 267
                      }
                    }
                  }
                },
                "span": {
                  "start": 255,
                  "end": 267
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 270,
                  "end": 271
                }
              }
            }
          },
          "span": {
            "start": 255,
            "end": 271
          }
        }
      },
      "span": {
        "start": 255,
        "end": 272
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 278,
                                      "end": 279
                                    }
                                  }
                                },
                                "span": {
                                  "start": 278,
                                  "end": 279
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 274,
                            "end": 279
                          }
                        }
                      },
                      "span": {
                        "start": 273,
                        "end": 280
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "p"
                      },
                      "span": {
                        "start": 282,
                        "end": 283
                      }
                    }
                  }
                },
                "span": {
                  "start": 273,
                  "end": 283
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 286,
                  "end": 287
                }
              }
            }
          },
          "span": {
            "start": 273,
            "end": 287
          }
        }
      },
      "span": {
        "start": 273,
        "end": 288
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 288
  }
}
