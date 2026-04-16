===source===
<?php
global $$foo->bar;
===errors===
expected variable, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Global": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Variable": "foo"
                      },
                      "span": {
                        "start": 14,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 18
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "bar"
                  },
                  "span": {
                    "start": 20,
                    "end": 23
                  }
                }
              }
            },
            "span": {
              "start": 13,
              "end": 23
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "->", expecting "," or ";" in Standard input code on line 2
