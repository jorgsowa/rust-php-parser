===source===
<?php

class A {
    public $prop = 42;
}

class B extends A {
    public $prop = 42 {
        get {
            yield parent::$prop::get() + 1;
            yield parent::$prop::get() + 2;
            yield parent::$prop::get() + 3;
        }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 8
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 8
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 28,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 41
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 49,
              "end": 50
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 59,
              "end": 60
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 74,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "StaticPropertyAccess": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "parent"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 119,
                                                              "end": 125
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 119,
                                                          "end": 125
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "prop"
                                                        },
                                                        "span": {
                                                          "start": 127,
                                                          "end": 132
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 119,
                                                    "end": 132
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "get"
                                                  },
                                                  "span": {
                                                    "start": 134,
                                                    "end": 137
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 119,
                                              "end": 139
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 142,
                                              "end": 143
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 119,
                                        "end": 143
                                      }
                                    },
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 113,
                                  "end": 143
                                }
                              }
                            },
                            "span": {
                              "start": 113,
                              "end": 144
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "StaticPropertyAccess": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "parent"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 163,
                                                              "end": 169
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 163,
                                                          "end": 169
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "prop"
                                                        },
                                                        "span": {
                                                          "start": 171,
                                                          "end": 176
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 163,
                                                    "end": 176
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "get"
                                                  },
                                                  "span": {
                                                    "start": 178,
                                                    "end": 181
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 163,
                                              "end": 183
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 2
                                            },
                                            "span": {
                                              "start": 186,
                                              "end": 187
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 163,
                                        "end": 187
                                      }
                                    },
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 157,
                                  "end": 187
                                }
                              }
                            },
                            "span": {
                              "start": 157,
                              "end": 188
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "StaticPropertyAccess": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "parent"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 207,
                                                              "end": 213
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 207,
                                                          "end": 213
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "prop"
                                                        },
                                                        "span": {
                                                          "start": 215,
                                                          "end": 220
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 207,
                                                    "end": 220
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "get"
                                                  },
                                                  "span": {
                                                    "start": 222,
                                                    "end": 225
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 207,
                                              "end": 227
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 3
                                            },
                                            "span": {
                                              "start": 230,
                                              "end": 231
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 207,
                                        "end": 231
                                      }
                                    },
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 201,
                                  "end": 231
                                }
                              }
                            },
                            "span": {
                              "start": 201,
                              "end": 232
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 95,
                        "end": 242
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 67,
                "end": 248
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 250
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 250
  }
}
