===source===
<?php
echo <<<END
		 a
		 END;
echo <<<'END'
	 END;
===errors===
Invalid indentation - tabs and spaces cannot be mixed
Invalid indentation - tabs and spaces cannot be mixed
===php_error===
PHP Parse error:  Invalid indentation - tabs and spaces cannot be mixed in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "END",
                "parts": [
                  {
                    "Literal": "a"
                  }
                ]
              }
            },
            "span": {
              "start": 11,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Nowdoc": {
                "label": "END",
                "value": ""
              }
            },
            "span": {
              "start": 36,
              "end": 50
            }
          }
        ]
      },
      "span": {
        "start": 31,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
