===source===
<?php
echo Enum::class;
$x = Enum::class;
register(Enum::class);
$y = new Enum();
Enum::method();
$z = \Enum::class;
$w = App\Models\Enum::class;
$q = enum();
$r = $obj instanceof Enum;
$arr = [Enum::class, Enum::FOO];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Identifier": "Enum"
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 17,
                    "end": 22
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "Enum"
                      },
                      "span": {
                        "start": 29,
                        "end": 33
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 35,
                        "end": 40
                      }
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 40
          }
        }
      },
      "span": {
        "start": 24,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "register"
                },
                "span": {
                  "start": 42,
                  "end": 50
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Identifier": "Enum"
                          },
                          "span": {
                            "start": 51,
                            "end": 55
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 57,
                            "end": 62
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 62
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 51,
                    "end": 62
                  }
                }
              ]
            }
          },
          "span": {
            "start": 42,
            "end": 63
          }
        }
      },
      "span": {
        "start": 42,
        "end": 64
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 65,
                  "end": 67
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Enum"
                      },
                      "span": {
                        "start": 74,
                        "end": 78
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 70,
                  "end": 80
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 80
          }
        }
      },
      "span": {
        "start": 65,
        "end": 81
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Enum"
                },
                "span": {
                  "start": 82,
                  "end": 86
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 88,
                  "end": 94
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 82,
            "end": 96
          }
        }
      },
      "span": {
        "start": 82,
        "end": 97
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 98,
                  "end": 100
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "\\Enum"
                      },
                      "span": {
                        "start": 103,
                        "end": 108
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 110,
                        "end": 115
                      }
                    }
                  }
                },
                "span": {
                  "start": 103,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 98,
            "end": 115
          }
        }
      },
      "span": {
        "start": 98,
        "end": 116
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "w"
                },
                "span": {
                  "start": 117,
                  "end": 119
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "App\\Models\\Enum"
                      },
                      "span": {
                        "start": 122,
                        "end": 137
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 139,
                        "end": 144
                      }
                    }
                  }
                },
                "span": {
                  "start": 122,
                  "end": 144
                }
              }
            }
          },
          "span": {
            "start": 117,
            "end": 144
          }
        }
      },
      "span": {
        "start": 117,
        "end": 145
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "q"
                },
                "span": {
                  "start": 146,
                  "end": 148
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "enum"
                      },
                      "span": {
                        "start": 151,
                        "end": 155
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 151,
                  "end": 157
                }
              }
            }
          },
          "span": {
            "start": 146,
            "end": 157
          }
        }
      },
      "span": {
        "start": 146,
        "end": 158
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r"
                },
                "span": {
                  "start": 159,
                  "end": 161
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 164,
                        "end": 168
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Enum"
                      },
                      "span": {
                        "start": 180,
                        "end": 184
                      }
                    }
                  }
                },
                "span": {
                  "start": 164,
                  "end": 184
                }
              }
            }
          },
          "span": {
            "start": 159,
            "end": 184
          }
        }
      },
      "span": {
        "start": 159,
        "end": 185
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 186,
                  "end": 190
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Identifier": "Enum"
                              },
                              "span": {
                                "start": 194,
                                "end": 198
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "class"
                              },
                              "span": {
                                "start": 200,
                                "end": 205
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 194,
                          "end": 205
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 194,
                        "end": 205
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Identifier": "Enum"
                              },
                              "span": {
                                "start": 207,
                                "end": 211
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "FOO"
                              },
                              "span": {
                                "start": 213,
                                "end": 216
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 207,
                          "end": 216
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 207,
                        "end": 216
                      }
                    }
                  ]
                },
                "span": {
                  "start": 193,
                  "end": 217
                }
              }
            }
          },
          "span": {
            "start": 186,
            "end": 217
          }
        }
      },
      "span": {
        "start": 186,
        "end": 218
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 218
  }
}
