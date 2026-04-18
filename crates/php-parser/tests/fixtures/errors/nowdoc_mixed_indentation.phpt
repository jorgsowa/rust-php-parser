===source===
<?php
$x = <<<'END'
	    mixed line
    END;
===errors===
Invalid body indentation level
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "END",
                    "value": "\t    mixed line"
                  }
                },
                "span": {
                  "start": 11,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 43
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
===php_error===
PHP Parse error:  Invalid indentation - tabs and spaces cannot be mixed in Standard input code on line 3
