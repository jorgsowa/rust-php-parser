===source===
<?php

new A()->foo;
new A()->foo();
new A()::FOO;
new A()::foo();
new A()::$foo;
new A()[0];
new A()();

new class {}->foo;
new class {}->foo();
new class {}::FOO;
new class {}::foo();
new class {}::$foo;
new class {}[0];
new class {}();
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
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 3,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 7,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 16,
                  "end": 19,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 19,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 21,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 25,
                        "end": 26,
                        "start_line": 4,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 21,
                  "end": 28,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 30,
                  "end": 33,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 21,
            "end": 35,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 37,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 41,
                        "end": 42,
                        "start_line": 5,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 37,
                  "end": 44,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "member": "FOO"
            }
          },
          "span": {
            "start": 37,
            "end": 49,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 37,
        "end": 51,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 55,
                        "end": 56,
                        "start_line": 6,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 51,
                  "end": 58,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "method": "foo",
              "args": []
            }
          },
          "span": {
            "start": 51,
            "end": 65,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 67,
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
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 71,
                        "end": 72,
                        "start_line": 7,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 67,
                  "end": 74,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "member": "foo"
            }
          },
          "span": {
            "start": 67,
            "end": 80,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 67,
        "end": 82,
        "start_line": 7,
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
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 86,
                        "end": 87,
                        "start_line": 8,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 82,
                  "end": 89,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 90,
                  "end": 91,
                  "start_line": 8,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 82,
            "end": 92,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 82,
        "end": 94,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 98,
                        "end": 99,
                        "start_line": 9,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 94,
                  "end": 101,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 94,
            "end": 103,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 94,
        "end": 106,
        "start_line": 9,
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
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 106,
                        "end": 118,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 106,
                  "end": 118,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 120,
                  "end": 123,
                  "start_line": 11,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 123,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 106,
        "end": 125,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 125,
                        "end": 137,
                        "start_line": 12,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 125,
                  "end": 137,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 139,
                  "end": 142,
                  "start_line": 12,
                  "start_col": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 125,
            "end": 144,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 125,
        "end": 146,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 146,
                        "end": 158,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 146,
                  "end": 158,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "member": "FOO"
            }
          },
          "span": {
            "start": 146,
            "end": 163,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 146,
        "end": 165,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 165,
                        "end": 177,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 165,
                  "end": 177,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "method": "foo",
              "args": []
            }
          },
          "span": {
            "start": 165,
            "end": 184,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 165,
        "end": 186,
        "start_line": 14,
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
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 186,
                        "end": 198,
                        "start_line": 15,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 186,
                  "end": 198,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "member": "foo"
            }
          },
          "span": {
            "start": 186,
            "end": 204,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 186,
        "end": 206,
        "start_line": 15,
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
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 206,
                        "end": 218,
                        "start_line": 16,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 206,
                  "end": 218,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 219,
                  "end": 220,
                  "start_line": 16,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 206,
            "end": 221,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 206,
        "end": 223,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 223,
                        "end": 235,
                        "start_line": 17,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 223,
                  "end": 235,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 223,
            "end": 237,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 223,
        "end": 238,
        "start_line": 17,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 238,
    "start_line": 1,
    "start_col": 0
  }
}
