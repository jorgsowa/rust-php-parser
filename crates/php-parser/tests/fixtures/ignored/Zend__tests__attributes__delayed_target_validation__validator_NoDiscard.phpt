===config===
min_php=8.5
===source===
<?php

class DemoClass {
	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}
}

$cases = [
	new ReflectionProperty('DemoClass', 'hooked')->getHook(PropertyHookType::Get),
	new ReflectionProperty('DemoClass', 'hooked')->getHook(PropertyHookType::Set),
];
foreach ($cases as $r) {
	echo str_repeat("*", 20) . "\n";
	echo $r . "\n";
	$attributes = $r->getAttributes();
	var_dump($attributes);
	try {
		$attributes[1]->newInstance();
	} catch (Error $e) {
		echo get_class($e) . ": " . $e->getMessage() . "\n";
	}
}

?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 13,
              "end": 22
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
                    "name": "hooked",
                    "span": {
                      "start": 40,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 129
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "hooked"
                                },
                                "span": {
                                  "start": 131,
                                  "end": 137
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 124,
                            "end": 137
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 54,
                              "end": 77
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 54,
                            "end": 77
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 83,
                              "end": 92
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 83,
                            "end": 92
                          }
                        }
                      ],
                      "span": {
                        "start": 52,
                        "end": 138
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 213,
                            "end": 219
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 143,
                              "end": 166
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 143,
                            "end": 166
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 172,
                              "end": 181
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 172,
                            "end": 181
                          }
                        }
                      ],
                      "span": {
                        "start": 141,
                        "end": 220
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 26,
                "end": 223
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 225
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "cases"
                },
                "span": {
                  "start": 227,
                  "end": 233
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
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "ReflectionProperty"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 243,
                                            "end": 261
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 243,
                                        "end": 261
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "DemoClass"
                                            },
                                            "span": {
                                              "start": 262,
                                              "end": 273
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 262,
                                          "end": 273
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "hooked"
                                            },
                                            "span": {
                                              "start": 275,
                                              "end": 283
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 275,
                                          "end": 283
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 239,
                                  "end": 284
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "getHook"
                                },
                                "span": {
                                  "start": 286,
                                  "end": 293
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "PropertyHookType"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 294,
                                                  "end": 310
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 294,
                                              "end": 310
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "Get"
                                            },
                                            "span": {
                                              "start": 312,
                                              "end": 315
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 294,
                                        "end": 315
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 294,
                                    "end": 315
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 239,
                            "end": 316
                          }
                        }
                      },
                      "span": {
                        "start": 239,
                        "end": 316
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "New": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "ReflectionProperty"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 323,
                                            "end": 341
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 323,
                                        "end": 341
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "DemoClass"
                                            },
                                            "span": {
                                              "start": 342,
                                              "end": 353
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 342,
                                          "end": 353
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "hooked"
                                            },
                                            "span": {
                                              "start": 355,
                                              "end": 363
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 355,
                                          "end": 363
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 319,
                                  "end": 364
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "getHook"
                                },
                                "span": {
                                  "start": 366,
                                  "end": 373
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "PropertyHookType"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 374,
                                                  "end": 390
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 374,
                                              "end": 390
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "Set"
                                            },
                                            "span": {
                                              "start": 392,
                                              "end": 395
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 374,
                                        "end": 395
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 374,
                                    "end": 395
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 319,
                            "end": 396
                          }
                        }
                      },
                      "span": {
                        "start": 319,
                        "end": 396
                      }
                    }
                  ]
                },
                "span": {
                  "start": 236,
                  "end": 399
                }
              }
            }
          },
          "span": {
            "start": 227,
            "end": 399
          }
        }
      },
      "span": {
        "start": 227,
        "end": 400
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "cases"
            },
            "span": {
              "start": 410,
              "end": 416
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "r"
            },
            "span": {
              "start": 420,
              "end": 422
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "str_repeat"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 432,
                                          "end": 442
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 432,
                                      "end": 442
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "String": "*"
                                          },
                                          "span": {
                                            "start": 443,
                                            "end": 446
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 443,
                                        "end": 446
                                      }
                                    },
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 20
                                          },
                                          "span": {
                                            "start": 448,
                                            "end": 450
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 448,
                                        "end": 450
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 432,
                                "end": 451
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 454,
                                "end": 458
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 432,
                          "end": 458
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 427,
                    "end": 459
                  }
                },
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "r"
                              },
                              "span": {
                                "start": 466,
                                "end": 468
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "\n"
                              },
                              "span": {
                                "start": 471,
                                "end": 475
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 466,
                          "end": 475
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 461,
                    "end": 476
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "attributes"
                            },
                            "span": {
                              "start": 478,
                              "end": 489
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "r"
                                  },
                                  "span": {
                                    "start": 492,
                                    "end": 494
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "getAttributes"
                                  },
                                  "span": {
                                    "start": 496,
                                    "end": 509
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 492,
                              "end": 511
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 478,
                        "end": 511
                      }
                    }
                  },
                  "span": {
                    "start": 478,
                    "end": 512
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
                                  "start": 514,
                                  "end": 522
                                }
                              }
                            },
                            "span": {
                              "start": 514,
                              "end": 522
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "attributes"
                                  },
                                  "span": {
                                    "start": 523,
                                    "end": 534
                                  }
                                }
                              },
                              "span": {
                                "start": 523,
                                "end": 534
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 514,
                        "end": 535
                      }
                    }
                  },
                  "span": {
                    "start": 514,
                    "end": 536
                  }
                },
                {
                  "kind": {
                    "TryCatch": {
                      "body": [
                        {
                          "kind": {
                            "Expression": {
                              "kind": {
                                "MethodCall": {
                                  "object": {
                                    "kind": {
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "Variable": "attributes"
                                          },
                                          "span": {
                                            "start": 546,
                                            "end": 557
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 558,
                                            "end": 559
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 546,
                                      "end": 560
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "newInstance"
                                    },
                                    "span": {
                                      "start": 562,
                                      "end": 573
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 546,
                                "end": 575
                              }
                            }
                          },
                          "span": {
                            "start": 546,
                            "end": 576
                          }
                        }
                      ],
                      "catches": [
                        {
                          "types": [
                            {
                              "parts": [
                                "Error"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 587,
                                "end": 592
                              }
                            }
                          ],
                          "var": {
                            "name": "e",
                            "span": {
                              "start": 593,
                              "end": 595
                            }
                          },
                          "body": [
                            {
                              "kind": {
                                "Echo": [
                                  {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "FunctionCall": {
                                                          "name": {
                                                            "kind": {
                                                              "Name": {
                                                                "parts": [
                                                                  "get_class"
                                                                ],
                                                                "kind": "Unqualified",
                                                                "span": {
                                                                  "start": 606,
                                                                  "end": 615
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 606,
                                                              "end": 615
                                                            }
                                                          },
                                                          "args": [
                                                            {
                                                              "name": null,
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "Variable": "e"
                                                                  },
                                                                  "span": {
                                                                    "start": 616,
                                                                    "end": 618
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 616,
                                                                "end": 618
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 606,
                                                        "end": 619
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": ": "
                                                      },
                                                      "span": {
                                                        "start": 622,
                                                        "end": 626
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 606,
                                                  "end": 626
                                                }
                                              },
                                              "op": "Concat",
                                              "right": {
                                                "kind": {
                                                  "MethodCall": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "e"
                                                      },
                                                      "span": {
                                                        "start": 629,
                                                        "end": 631
                                                      }
                                                    },
                                                    "method": {
                                                      "kind": {
                                                        "Identifier": "getMessage"
                                                      },
                                                      "span": {
                                                        "start": 633,
                                                        "end": 643
                                                      }
                                                    },
                                                    "args": []
                                                  }
                                                },
                                                "span": {
                                                  "start": 629,
                                                  "end": 645
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 606,
                                            "end": 645
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "\n"
                                          },
                                          "span": {
                                            "start": 648,
                                            "end": 652
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 606,
                                      "end": 652
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 601,
                                "end": 653
                              }
                            }
                          ],
                          "span": {
                            "start": 586,
                            "end": 656
                          }
                        }
                      ],
                      "finally": null
                    }
                  },
                  "span": {
                    "start": 538,
                    "end": 656
                  }
                }
              ]
            },
            "span": {
              "start": 424,
              "end": 658
            }
          }
        }
      },
      "span": {
        "start": 401,
        "end": 658
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 658
  }
}
