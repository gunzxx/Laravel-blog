class Trix.FileVerificationOperation extends Trix.Operation
  constructor: (@file) ->
    super(arguments...)

  perform: (callback) ->
    reader = new FileReader

    reader.onerror = ->
      callback(false)

    reader.onload = =>
      reader.onerror = null
      try reader.abort()
      callback(true, @file)

    reader.readAsArrayBuffer(@file)
