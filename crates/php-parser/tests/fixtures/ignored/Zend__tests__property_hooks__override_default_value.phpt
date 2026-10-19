===source===
<?php

class A {
    public $prop = 41;
}

class B extends A {
    public $prop = 42 {
        get {
            return 43;
        }
    }
}

$b = new B();
var_dump($b);
var_dump($b->prop);
$b->prop = 44;
var_dump($b);
var_dump($b->prop);

?>
===ast >=8.5===
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
                      "Int": 41
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
                              "Return": {
                                "kind": {
                                  "Int": 43
                                },
                                "span": {
                                  "start": 120,
                                  "end": 122
                                }
                              }
                            },
                            "span": {
                              "start": 113,
                              "end": 123
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 95,
                        "end": 133
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 67,
                "end": 139
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 43,
        "end": 141
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 143,
                  "end": 145
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 152,
                            "end": 153
                          }
                        }
                      },
                      "span": {
                        "start": 152,
                        "end": 153
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 148,
                  "end": 155
                }
              }
            }
          },
          "span": {
            "start": 143,
            "end": 155
          }
        }
      },
      "span": {
        "start": 143,
        "end": 156
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 157,
                      "end": 165
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 165
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 166,
                        "end": 168
                      }
                    }
                  },
                  "span": {
                    "start": 166,
                    "end": 168
                  }
                }
              ]
            }
          },
          "span": {
            "start": 157,
            "end": 169
          }
        }
      },
      "span": {
        "start": 157,
        "end": 170
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 171,
                      "end": 179
                    }
                  }
                },
                "span": {
                  "start": 171,
                  "end": 179
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 180,
                              "end": 182
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "prop"
                            },
                            "span": {
                              "start": 184,
                              "end": 188
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 180,
                        "end": 188
                      }
                    }
                  },
                  "span": {
                    "start": 180,
                    "end": 188
                  }
                }
              ]
            }
          },
          "span": {
            "start": 171,
            "end": 189
          }
        }
      },
      "span": {
        "start": 171,
        "end": 190
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
                        "Variable": "b"
                      },
                      "span": {
                        "start": 191,
                        "end": 193
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "prop"
                      },
                      "span": {
                        "start": 195,
                        "end": 199
                      }
                    }
                  }
                },
                "span": {
                  "start": 191,
                  "end": 199
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 44
                },
                "span": {
                  "start": 202,
                  "end": 204
                }
              }
            }
          },
          "span": {
            "start": 191,
            "end": 204
          }
        }
      },
      "span": {
        "start": 191,
        "end": 205
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 206,
                      "end": 214
                    }
                  }
                },
                "span": {
                  "start": 206,
                  "end": 214
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 215,
                        "end": 217
                      }
                    }
                  },
                  "span": {
                    "start": 215,
                    "end": 217
                  }
                }
              ]
            }
          },
          "span": {
            "start": 206,
            "end": 218
          }
        }
      },
      "span": {
        "start": 206,
        "end": 219
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
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 220,
                      "end": 228
                    }
                  }
                },
                "span": {
                  "start": 220,
                  "end": 228
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 229,
                              "end": 231
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "prop"
                            },
                            "span": {
                              "start": 233,
                              "end": 237
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 229,
                        "end": 237
                      }
                    }
                  },
                  "span": {
                    "start": 229,
                    "end": 237
                  }
                }
              ]
            }
          },
          "span": {
            "start": 220,
            "end": 238
          }
        }
      },
      "span": {
        "start": 220,
        "end": 239
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 239
  }
}
